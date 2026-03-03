<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Goal;
use Illuminate\Http\Request;
class GoalController extends Controller
{
    public function index() { $goals = Goal::orderBy('id', 'DESC')->get(); return view('admin.goals.index', compact('goals')); }
    public function store(Request $r) { Goal::create($r->all()); return back()->with('success', 'Goal added'); }
    public function update(Request $r, Goal $goal) { $goal->update(['current' => $r->current]); $goal->update(['achieved' => $goal->current >= $goal->target]); return back()->with('success', 'Goal updated'); }
    public function destroy(Goal $goal) { $goal->delete(); return back()->with('success', 'Goal deleted'); }
}
