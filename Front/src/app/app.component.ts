import { Component  } from '@angular/core';
import { RouterOutlet, RouterLink } from '@angular/router';

import { HomeComponent } from './pages/home/home.component';
import { LoginComponent } from './pages/login/login.component';
import { RegisterComponent } from './pages/register/register.component';
import { MyAccountComponent } from './pages/my-account/my-account.component';
import { SetComponent } from './pages/set/set.component';

import { SecurityService } from './services/security.service';

@Component({
  selector: 'app-root',
  standalone: true,
  imports: [RouterOutlet,
    RouterLink,
    HomeComponent,
    LoginComponent,
    RegisterComponent,
    MyAccountComponent,
    SetComponent,
  ],
  templateUrl: './app.component.html',
  styleUrl: './app.component.css',
})
export class AppComponent {
    title = "Fiszlet";
    users: any;

    constructor(private dataService: SecurityService) { }

    newPost = {
        "type": "xdd",
        "users": []
    };

    ngOnInit(): void {
        this.dataService.getUsers().subscribe({
            next: data => {
                this.users = data['hydra:member'];
                // console.log(data['hydra:member']);
            },
            error: error => {
                console.error('Error fetching user data:', error);
            }
        });
    }

}
