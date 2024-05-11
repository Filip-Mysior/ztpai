import { Routes } from '@angular/router';

import { HomeComponent } from './home/home.component';
import { LoginComponent } from './login/login.component';
import { RegisterComponent } from './register/register.component';
import { MyAccountComponent } from './my-account/my-account.component';
import { SetComponent } from './set/set.component';
import { LearnComponent } from './learn/learn.component';

export const routes: Routes = [
    { path: '', component: HomeComponent },
    { path: 'login', component: LoginComponent, },
    { path:'register', component: RegisterComponent },
    { path:'my-account', component: MyAccountComponent },
    { path:'set', component: SetComponent },
    { path:'learn', component: LearnComponent },
    { path: '**', redirectTo: '' },
];
