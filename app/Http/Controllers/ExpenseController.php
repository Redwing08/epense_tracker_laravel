<?php

namespace App\Http\Controllers;

use App\Models\Expense; //Models
use App\Models\Categories; //Models
use Illuminate\Http\Request; //Models
use Illuminate\Support\Facades\DB; //This is for raw typing of DB

class ExpenseController extends Controller
{
    public function index()
    {
        // Fetch all expenses along with their categories, and all categories for the form
        $expenses = Expense::with('category')->latest()->get();
        $categories = Categories::all();

        return view('expenses.index', compact('expenses', 'categories'));
    }

    public function store(Request $request)
    {
        // Validate the incoming form data
        $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'expense_date' => 'required|date',
        ]);

        // Save the expense to the database
        Expense::create($request->all());

        return redirect()->back()->with('success', 'Expense added successfully!');
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();
        return redirect()->back()->with('success', 'Expense deleted successfully!');
    }
    

        public function dashboard()
    {
        // Aggregate Metrics
        $totalExpenses = Expense::sum('amount');
        $totalTransactions = Expense::count();
        $totalCategories = Categories::count();

        // Recent 5 Transactions for Quick Ledger
        $recentExpenses = Expense::with('category')->latest()->take(5)->get();

        // Category Breakdown (Total spent per category)
        $categoriesBreakdown = Categories::withCount('expenses')
            ->withSum('expenses', 'amount')
            ->get();

        return view('dashboard', compact(
            'totalExpenses',
            'totalTransactions',
            'totalCategories',
            'recentExpenses',
            'categoriesBreakdown'
        ));
    }


    // Show the edit form for a specific expense
    public function edit($id)
    {
        $expense = Expense::findOrFail($id);
        $categories = Categories::all();
        return view('expenses.edit', compact('expense', 'categories'));
    }

    // Update the edited expense in the database
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'expense_date' => 'required|date',
        ]);

        $expense = Expense::findOrFail($id);
        $expense->update([
            'title' => $request->title,
            'amount' => $request->amount,
            'category_id' => $request->category_id,
            'expense_date' => $request->expense_date,
        ]);

        return redirect()->route('expenses.index')->with('success', 'Transaction updated successfully!');
    }



    // Show Category Management Page
        public function categoriesIndex()
        {
            $categories = Categories::withCount('expenses')->get();
            return view('categories.index', compact('categories'));
        }

        // Store New Category
        public function categoriesStore(Request $request)
        {
            $request->validate([
                'name' => 'required|string|max:255|unique:categories,name',
            ]);

            Categories::create([
                'name' => $request->name,
            ]);

            return redirect()->back()->with('success', 'Category added successfully!');
        }

// Show Edit Form for Category
        public function categoriesEdit($id)
        {
            $category = Categories::findOrFail($id);
            return view('categories.edit', compact('category'));
        }

        // Update Category in Database
        public function categoriesUpdate(Request $request, $id)
        {
            $request->validate([
                'name' => 'required|string|max:255|unique:categories,name,' . $id,
            ]);

            $category = Categories::findOrFail($id);
            $category->update([
                'name' => $request->name,
            ]);

            return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
        }

// public function index()
// {
//     // Runs a raw SQL SELECT query
//     $expenses = DB::select('select * from expenses order by created_at desc');
//     $categories = DB::select('select * from categories');

//     return view('expenses.index', compact('expenses', 'categories'));
// }


   public function categoriesDelete($id)
{
    // Corrected SQL syntax (removed '*') and added security bindings (?)
    DB::delete('DELETE FROM expenses WHERE category_id = ?', [$id]);
    DB::delete('DELETE FROM categories WHERE id = ?', [$id]);

    return redirect()->back()->with('success', 'Category and associated expenses deleted successfully!');
}


}