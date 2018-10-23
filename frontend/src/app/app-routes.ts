import { Routes } from "@angular/router";
import { DashboardComponent } from "./modules/users/dashboard/dashboard.component";
import { LoginComponent } from "./login/login.component";

export const routes:Routes = [
    {path:'dashboard', component:DashboardComponent},
    {path:'login', component:LoginComponent},
    { path: ''  , redirectTo: 'dashboard', pathMatch: 'full' },
    { path: '**', redirectTo: 'dashboard', pathMatch: 'full' }
];