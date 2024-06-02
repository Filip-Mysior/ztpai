import { Component, OnInit } from '@angular/core';
import { RouterOutlet, Router } from '@angular/router';

import { HomeComponent } from './pages/home/home.component';
import { LoginComponent } from './pages/login/login.component';
import { RegisterComponent } from './pages/register/register.component';
import { MyAccountComponent } from './pages/my-account/my-account.component';
import { SetComponent } from './pages/set/set.component';

import { UserService } from './services/user.service';

@Component({
  selector: 'app-root',
  standalone: true,
  imports: [RouterOutlet,
    HomeComponent,
    LoginComponent,
    RegisterComponent,
    MyAccountComponent,
    SetComponent,
  ],
  templateUrl: './app.component.html',
  styleUrl: './app.component.css',
})
export class AppComponent  {
    title = "Fiszlet";

    constructor(
        private router: Router,
        private userService: UserService,
    ) {}

    logout(): void {
        localStorage.removeItem('authToken');
        this.router.navigate(['/login']).then(() => {
            window.location.reload();
          });
    }

    redirectTo(page: string) {
        this.router.navigate(['/', page]);
    }

    public isUserLoggedIn(): boolean {
        return this.userService.isUserLoggedIn();
    }

    public isUserAdmin(): boolean {
        return this.userService.isUserAdmin();
    }
}
