import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable, throwError } from 'rxjs';
import { catchError } from 'rxjs/operators';

@Injectable({
  providedIn: 'root'
})
export class SetService {
    private api = 'http://localhost:8000/api/sets';

    constructor(private http: HttpClient) { }
}
