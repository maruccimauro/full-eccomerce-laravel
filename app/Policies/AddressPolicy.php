<?php

namespace App\Policies;

use App\Models\Address;
use App\Models\User;

class AddressPolicy
{
    /**
     * Determina si el usuario puede ver cualquier dirección (listado).
     */
    public function viewAny(User $user): bool
    {
        return true; // cualquier usuario autenticado puede listar sus direcciones
    }

    /**
     * Determina si el usuario puede ver una dirección específica.
     */
    public function view(User $user, Address $address): bool
    {
        return $user->id === $address->user_id;
    }

    /**
     * Determina si el usuario puede crear direcciones.
     */
    public function create(User $user): bool
    {
        return true; // puedes agregar lógica más compleja si fuese necesario
    }

    /**
     * Determina si el usuario puede actualizar una dirección.
     */
    public function update(User $user, Address $address): bool
    {
        return $user->id === $address->user_id;
    }

    /**
     * Determina si el usuario puede eliminar una dirección.
     */
    public function delete(User $user, Address $address): bool
    {
        return $user->id === $address->user_id;
    }

    /**
     * Restauración deshabilitada.
     */
    public function restore(User $user, Address $address): bool
    {
        return false;
    }

    /**
     * Eliminación permanente deshabilitada.
     */
    public function forceDelete(User $user, Address $address): bool
    {
        return false;
    }
}
