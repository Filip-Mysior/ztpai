import { Component } from '@angular/core';
import { RouterLink, Router } from '@angular/router';
import { AbstractControl,
    FormBuilder,
    FormGroup,
    FormControl,
    Validators,
    ReactiveFormsModule,
} from '@angular/forms';

import { SecurityService } from '../../services/security.service';

@Component({
  selector: 'app-login',
  standalone: true,
  imports: [ReactiveFormsModule, RouterLink],
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css', '../../styles/login.css']
})
export class LoginComponent {

    loginForm: FormGroup = new FormGroup({
        email: new FormControl(''),
        password: new FormControl(''),
    });
    submitted = false;
    loginMsg = "";

    constructor(
        private securityService: SecurityService,
        private formBuilder: FormBuilder,
        private router: Router,
    ) { }


    ngOnInit(): void {
        this.loginForm = this.formBuilder.group(
            {
                email: ['', [Validators.required, Validators.pattern("^[a-z0-9._%+-]+@[a-z0-9.-]+\\.[a-z]{2,4}$")]],
                password: [
                '',
                [
                    Validators.required,
                    Validators.minLength(4),
                    Validators.maxLength(40),
                ],
                ],
            }
        );
    }

    get f(): { [key: string]: AbstractControl } {
        return this.loginForm.controls;
    }


    submitForm(): void {
        this.submitted = true;

        if (this.loginForm.invalid) {
            return;
        }

        const formData = {
            email: this.loginForm.value.email,
            password: this.loginForm.value.password,
        }
        
        this.securityService.loginUser(formData).subscribe({
            next: response => {
                this.loginMsg = "Logged in successfully, redirecting...   " + response.userId + "   " + response.token;
                setTimeout(() => {
                    this.router.navigate(['/']);
                }, 1000);
            },
            error: error => {
                this.loginMsg = "Error logging in.";
            }
        });

    }
}
