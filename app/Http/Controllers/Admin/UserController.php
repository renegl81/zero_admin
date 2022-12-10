<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    /**
     * @var UserService
     */
    protected UserService $userService;

    /**
     * @param  UserService  $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        return Inertia::render('Admin/User/Index', [
            'users' => UserResource::arrayCollection($this->userService->all()),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        return Inertia::render('Admin/User/New', [
            'action' => 'create',
        ]);
    }

    /**
     * Show the form for register a new resource.
     *
     * @return Response
     */
    public function request(): Response
    {
        return Inertia::render('Admin/User/New', [
            'action' => 'register',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserRequest  $request
     * @return RedirectResponse
     */
    public function storeRequest(UserRequest $request): RedirectResponse
    {
        $user = $this->userService->createAccount($request);
        if (! $user) {
            return Redirect::route('admin_user_index')
                ->with('error', __('admin.notifications.error.operation'));
        }

        return Redirect::route('admin_user_index')
            ->with('success', __('admin.notifications.requestUser'));
    }

    /**
     * Display the specified resource.
     *
     * @param  User  $user
     * @return void
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Response
     */
    public function edit($id): Response
    {
        return Inertia::render('Admin/User/Edit', [
            'user' => $this->userService->get($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserRequest  $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(UserRequest $request, $id): RedirectResponse
    {
        if ($this->userService->updateUser($request, $id)) {
            return Redirect::route('admin_user_index')
                ->with('success', __('admin.notifications.editSuccess.user'));
        }

        return Redirect::route('admin_user_index')
            ->with('error', __('admin.notifications.error.operation'));
    }
}
