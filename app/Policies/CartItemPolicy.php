<?php

namespace App\Policies;

use App\Enums\UserRoleEnum;
use App\Fields\CartFields;
use App\Fields\UserFields;
use App\Models\CartItem;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CartItemPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole(UserRoleEnum::ADMIN);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, CartItem $cartItem): bool
    {
        $isOwned = (int)$user->{UserFields::ID} === (int)$cartItem->cart->{CartFields::USER_ID};
        return $isOwned;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, CartItem $cartItem): bool
    {
        $isOwned = (int)$user->{UserFields::ID} === (int)$cartItem->cart->{CartFields::USER_ID};
        return $isOwned;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, CartItem $cartItem): bool
    {
        $isOwned = (int)$user->{UserFields::ID} === (int)$cartItem->cart->{CartFields::USER_ID};
        return $isOwned;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, CartItem $cartItem): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, CartItem $cartItem): bool
    {
        return false;
    }
}
