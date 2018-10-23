import { Routes } from "@angular/router";
import { UserListComponent } from "./user-list/user-list.component";
import { UserDetailsComponent } from "./user-details/user-details.component";
import { AuthGuard } from "../core/auth.guard";

export const userRoutes:Routes = [
    { path: 'users', data: {}, component: UserListComponent, canActivate:[AuthGuard] },
    { path: 'user/:id', data: {}, component: UserDetailsComponent, canActivate:[AuthGuard] },
];

