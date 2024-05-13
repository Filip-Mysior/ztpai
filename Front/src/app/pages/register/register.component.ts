import { Component } from '@angular/core';
import { RouterLink, Router } from '@angular/router';
import { AbstractControl,
    FormBuilder,
    FormGroup,
    FormControl,
    Validators,
    ReactiveFormsModule,
} from '@angular/forms';

import Validation from '../../utils/validation';
import { SecurityService } from '../../services/security.service';


@Component({
  selector: 'app-register',
  standalone: true,
  imports: [ReactiveFormsModule, RouterLink],
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css', '../../styles/login.css']
})
export class RegisterComponent {

    registerForm: FormGroup = new FormGroup({
        login: new FormControl(''),
        email: new FormControl(''),
        password: new FormControl(''),
        confirmPassword: new FormControl(''),
    });
    submitted = false;
    registerMsg = "";

    constructor(
        private securityService: SecurityService,
        private formBuilder: FormBuilder,
        private router: Router,
    ) { }


    ngOnInit(): void {
        this.registerForm = this.formBuilder.group(
            {
                login: ['', Validators.required],
                email: ['', [Validators.required, Validators.pattern("^[a-z0-9._%+-]+@[a-z0-9.-]+\\.[a-z]{2,4}$")]],
                password: [
                '',
                [
                    Validators.required,
                    Validators.minLength(4),
                    Validators.maxLength(40),
                ],
                ],
                confirmPassword: ['', Validators.required],
            },
            {
                validators: [Validation.match('password', 'confirmPassword')],
            }
        );
    }

    get f(): { [key: string]: AbstractControl } {
        return this.registerForm.controls;
    }


    submitForm(): void {
        this.submitted = true;

        if (this.registerForm.invalid) {
            return;
        }

        const formData = {
            login: this.registerForm.value.login,
            email: this.registerForm.value.email,
            password: this.registerForm.value.password,
        }
        
        this.securityService.addUser(formData).subscribe({
            next: response => {
                this.registerMsg = "Registered successfully, redirecting...";
                setTimeout(() => {
                    this.router.navigate(['/login']);
                }, 1000);
            },
            error: error => {
                this.registerMsg = "Error registering, please try again later.";
            }
        });

    }
}
