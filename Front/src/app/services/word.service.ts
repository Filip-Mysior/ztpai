import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable, throwError } from 'rxjs';
import { catchError } from 'rxjs/operators';

@Injectable({
    providedIn: 'root'
})
export class WordService {
    private api = 'http://localhost:8000/api/words';

    constructor(private http: HttpClient) { }

    addWord(formData: FormData): Observable<any> {
        return this.http.post<any>(`${this.api}/basic/add`, formData).pipe(
            catchError(error => {
                console.error('Error adding set:', error);
                return throwError(() => new Error('Failed to add set.'));
            })
        );
    }

    deleteWord(wordId: number): Observable<any> {
        return this.http.delete<any>(`${this.api}/${wordId}`).pipe(
          catchError(error => {
            console.error('Error deleting word:', error);
            return throwError(() => new Error('Failed to delete word.'));
          })
        );
    }

    getWordsInSet(setId: number): Observable<any> {
        return this.http.get<any>(`${this.api}/set/${setId}`).pipe(
            catchError(error => {
                console.error('Error fetching JSON data:', error);
                return throwError(()=> new Error('Something went wrong; please try again later.'));
            })
        );
    }
}
