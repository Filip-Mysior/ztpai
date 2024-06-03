import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable, throwError } from 'rxjs';
import { catchError } from 'rxjs/operators';

@Injectable({
    providedIn: 'root'
})
export class SetService {
    private api = 'http://localhost:8000/api/sets';
    private apiBasic = 'http://localhost:8000/api/sets/basic';

    constructor(private http: HttpClient) { }

    getSets(): Observable<any> {
        return this.http.get<any>(`${this.apiBasic}/all`).pipe(
            catchError(error => {
                console.error('Error fetching JSON data:', error);
                return throwError(()=> new Error('Something went wrong; please try again later.'));
            })
        );
    }

    getSet(setId: number): Observable<any> {
        return this.http.get<any>(`${this.apiBasic}/${setId}`).pipe(
            catchError(error => {
                console.error('Error fetching JSON data:', error);
                return throwError(()=> new Error('Something went wrong; please try again later.'));
            })
        );
    }

    addSet(formData: FormData): Observable<any> {
        return this.http.post<any>(`${this.apiBasic}/add`, formData).pipe(
            catchError(error => {
                console.error('Error adding set:', error);
                return throwError(() => new Error('Failed to add set.'));
            })
        );
    }

    deleteSet(setId: number): Observable<any> {
        return this.http.delete<any>(`${this.api}/${setId}`).pipe(
          catchError(error => {
            console.error('Error deleting set:', error);
            return throwError(() => new Error('Failed to delete set.'));
          })
        );
    }

    searchSets(searchTerm: string): Observable<any> {
        return this.http.get<any>(`${this.api}/search/name?name=${searchTerm}`).pipe(
            catchError(error => {
                console.error('Error searching sets:', error);
                return throwError(() => new Error('Failed to search sets.'));
            })
        );
    }

    getHistory(): Observable<any> {
        return this.http.get<any>(`${this.api}/history/get`).pipe(
            catchError(error => {
                console.error('Error fetching JSON data:', error);
                return throwError(()=> new Error('Something went wrong; please try again later.'));
            })
        );
    }
}
