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
}
