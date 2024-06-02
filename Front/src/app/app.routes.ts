import { Routes } from '@angular/router';

import { HomeComponent } from './pages/home/home.component';
import { LoginComponent } from './pages/login/login.component';
import { RegisterComponent } from './pages/register/register.component';
import { MyAccountComponent } from './pages/my-account/my-account.component';
import { SetComponent } from './pages/set/set.component';
import { LearnComponent } from './pages/learn/learn.component';

import { authGuard, loggedInAuthGuard } from './services/auth.guard';

export const routes: Routes = [
    { path: '', component: HomeComponent },
    { path: 'login', component: LoginComponent, canActivate: [loggedInAuthGuard] },
    { path:'register', component: RegisterComponent, canActivate: [loggedInAuthGuard] },
    { path:'my-account', component: MyAccountComponent, canActivate: [authGuard] },
    { path:'set/:id', component: SetComponent },
    { path:'learn/:id', component: LearnComponent },
    { path: '**', redirectTo: '' },
];
