import { Routes } from '@angular/router';

import { HomeComponent } from './pages/home/home.component';
import { LoginComponent } from './pages/login/login.component';
import { RegisterComponent } from './pages/register/register.component';
import { MyAccountComponent } from './pages/my-account/my-account.component';
import { SetComponent } from './pages/set/set.component';
import { LearnComponent } from './pages/learn/learn.component';

export const routes: Routes = [
    { path: '', component: HomeComponent },
    { path: 'login', component: LoginComponent, },
    { path:'register', component: RegisterComponent },
    { path:'my-account', component: MyAccountComponent },
    { path:'set', component: SetComponent },
    { path:'set/:id', component: SetComponent },
    { path:'learn', component: LearnComponent },
    { path: '**', redirectTo: '' },
];
