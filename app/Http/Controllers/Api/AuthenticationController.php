<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends BaseController
{
    /**
     *    @OA\Post(
     *       path="/login",
     *       tags={"Authentication"},
     *       operationId="",
     *       summary="Kategori Berita",
     *       description="Melakukan Login",
    *          @OA\Parameter(
     *         name="email",
     *         in="query",
     *         description="email",
     *         required=true,
     *      ),
     *      @OA\Parameter(
     *         name="password",
     *         in="query",
     *         description="password",
     *         required=true,
     *      ),
     * 
     *       @OA\Response(
     *           response="200",
     *           description="Ok",
     *           @OA\JsonContent
     *           (example={
     *               "data": {
     *                  "id": 1,
     *                  "name": "Andrey Andriansyah",
     *                  "email": "andreyandri90@gmail.com",
     *                   "email_verified_at": "2024-05-14T13:29:34.000000Z",
     *                  "created_at": "2024-05-14T13:29:35.000000Z",
     *                  "updated_at": "2024-05-14T13:29:35.000000Z",
     *                  "token": "17|GVc87mwm76INumqsdwWgqaXe3zLu8SYyX8cVm8Bkc8604b3f"
     *                }
     *          }),
     *      ),
     *  )
     */
    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->all(), true)) {
            Auth::user()->tokens()->delete();
            $token = Auth::user()->createToken("Auth");
            $data = Auth::user();
            $data["token"] = $token->plainTextToken;
            return $this->sendResponse($data, "Login Berhasil");
        } else {
            return $this->sendError("Login Gagal", "Silahkan Periksa Kembali Email / Password", 403);
        }
    }
}
