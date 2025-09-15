<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreActorsRequest;
use App\Models\ActorSubmission;
use App\Services\ActorParsingService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
class ActorSubmissionController extends Controller
{
    public function __construct(private readonly ActorParsingService $parsing)
    {
    }

    public function create(): View
    {
        return view('actors.create');
    }

    public function store(StoreActorsRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $dto = $this->parsing->parse($validated['actor_description']);

        if (!$dto?->hasRequired()) {
            return back()
                ->withInput()
                ->withErrors([
                    'actor_description' => 'Please add first name, last name, and address to your description.',
                ]);
        }

        ActorSubmission::create([
            'email' => $validated['email'],
            'actor_description' => $validated['actor_description'],
            'first_name' => $dto->first_name,
            'last_name' => $dto->last_name,
            'address' => $dto->address,
            'height' => $dto->height,
            'weight' => $dto->weight,
            'gender' => $dto->gender,
            'age' => $dto->age,
            'parsed_at' => now(),
        ]);

        return redirect()->route('actors.index')
            ->with('status', 'Submission saved.');
    }

    public function index(): View
    {
        $submissions = ActorSubmission::latest()->get();

        return view('actors.index', compact('submissions'));
    }
}

