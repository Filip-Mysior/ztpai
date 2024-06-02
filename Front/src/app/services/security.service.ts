import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable, throwError } from 'rxjs';
import { catchError } from 'rxjs/operators';

@Injectable({
  providedIn: 'root'
})
export class SecurityService {
    private regApi = 'http://localhost:8000/api/register';
    private logApi = 'http://localhost:8000/api/login';

    constructor(private http: HttpClient) { }

    addUser(newUser: any): Observable<any> {
        const headers = { 'Content-Type': 'application/ld+json' };

        return this.http.post<any>(`${this.regApi}`, newUser, { headers }).pipe(
            catchError(error => {
                console.error('Error adding user:', error);
                return throwError(()=> new Error('Failed to add user.'));
            })
        );
    }

    loginUser(User: any): Observable<any> {
        const options = {
            headers: {
              'Content-Type': 'application/json',
            },
            mode: 'no-cors',
          };
        
        return this.http.post<any>(`${this.logApi}`, User, options).pipe(
            catchError(error => {
                console.error('Error loggin in:', error);
                return throwError(()=> new Error('Invalid credentials.'));
            })
        );
    }
}
