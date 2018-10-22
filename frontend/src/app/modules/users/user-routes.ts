import { Routes } from "@angular/router";
import { DashboardComponent } from "./dashboard/dashboard.component";
import { UserListComponent } from "./user-list/user-list.component";
import { UserDetailsComponent } from "./user-details/user-details.component";


export const userRoutes:Routes = [
    { path: 'users', data: {}, component: UserListComponent },
    { path: 'user/:id', data: {}, component: UserDetailsComponent },
];

