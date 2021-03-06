<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\User;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    // 用于用户更新时的权限验证
    // update 方法接收两个参数，第一个参数默认为当前登录用户实例，第二个参数则为要进行授权的用户实例
    public function update(User $currentUser, User $user) {
        return $currentUser->id === $user->id;
    }

    // 只有当前用户拥有管理员权限且删除的用户不是自己时才显示链接
    public function destroy(User $currentUser, User $user) {
        return $currentUser->is_admin && $currentUser->id !== $user->id;
    }
}
