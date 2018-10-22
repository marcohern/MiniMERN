import { Routes } from "@angular/router";
import { DashboardComponent } from "./modules/users/dashboard/dashboard.component";

export const routes:Routes = [
    {path:'dashboard', component:DashboardComponent},
    { path: ''  , redirectTo: 'dashboard', pathMatch: 'full' },
    { path: '**', redirectTo: 'dashboard', pathMatch: 'full' }
];