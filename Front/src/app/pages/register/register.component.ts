import { Component } from '@angular/core';
import { AbstractControl,
    FormBuilder,
    FormGroup,
    FormControl,
    Validators,
    ReactiveFormsModule,
} from '@angular/forms';

import Validation from '../../utils/validation';
import { UserService } from '../../services/user.service';


@Component({
  selector: 'app-register',
  standalone: true,
  imports: [ReactiveFormsModule],
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

    constructor(
        private userService: UserService,
        private formBuilder: FormBuilder,
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

        console.log(JSON.stringify(this.registerForm.value, null, 2));
        console.log((formData));
        
        this.userService.addUser(formData).subscribe({
            next: response => {
                console.log('Registered successfully:', response)
            },
            error: error => {
                console.error('Error registering:', error)
            }
        });

    }


    // registerForm = this.formBuilder.group({
    // //     "login": "",
    // //     "password": "",
    // //     "email": "",
    // //     "profile_picture_path": "assets/profile.png",
    // //     "user_type": "/api/user_types/1",
    // //     "sets": [],
    // //     "profilePicturePath": "assets/profile.png",
    // //     "userType": "/api/user_types/1"
    // });

    // onSubmit(): void {
    // //     this.userService.addUser(this.registerForm).subscribe({
    // //         next: response => {
    // //         console.log('Post added successfully:', response)
    // //         },
    // //         error: error => {
    // //         console.error('Error adding post:', error)
    // //         }
    // //     });
    // }
}
