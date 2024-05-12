import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable, throwError } from 'rxjs';
import { catchError } from 'rxjs/operators';

@Injectable({
  providedIn: 'root'
})
export class UserService {
    private api = 'http://localhost:8000/api/users';
    private regApi = 'http://localhost:8000/api/register';

    constructor(private http: HttpClient) { }

    getUsers(): Observable<any> {
        return this.http.get<any>(`${this.api}`).pipe(
            catchError(error => {
                console.error('Error fetching JSON data:', error);
                return throwError(()=> new Error('Something went wrong; please try again later.'));
            })
        );
    }

    addUser(newUser: any): Observable<any> {
        const headers = { 'Content-Type': 'application/ld+json' };

        return this.http.post<any>(`${this.regApi}`, newUser, { headers }).pipe(
            catchError(error => {
                console.error('Error adding user:', error);
                return throwError(()=> new Error('Failed to add user.'));
            })
        );
    }
}
