<?php

namespace App\Http\Controllers\Users;

use App\Actions\AdminsManagement\DeleteAdminAction;
use App\Actions\AdminsManagement\GetAdminsListAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\CredentialsValidation\RegisterRequest;
use App\Services\Authentication\RegisterService;
use Illuminate\Http\JsonResponse;

class MasterAdminController extends Controller
{
    //create new account for new admin
    public function addAdmin(RegisterRequest $request, RegisterService $service): JsonResponse
    {
        $service->storeUser($request->name,$request->email,$request->password,'admin');
        return response()->json('success');
    }

    public function deleteAdmin($admin_id, DeleteAdminAction $action): JsonResponse
    {
        return response()->json($action->removeAdmin($admin_id));
    }

    public function getAdminsList(GetAdminsListAction $action){
        return response()->json($action->getAdmins());
    }
}
