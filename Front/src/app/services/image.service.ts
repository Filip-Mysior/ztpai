import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable, throwError } from 'rxjs';
import { catchError } from 'rxjs/operators';

@Injectable({
  providedIn: 'root'
})
export class ImageService {
    private imageApi = 'http://localhost:8000/api/image';

    constructor(private http: HttpClient) { }

    getImageUrl(imageId: number): string {
        return `${this.imageApi}/${imageId}`;
    }

    uploadImage(formData: FormData): Observable<any> {
        return this.http.post<any>(`${this.imageApi}`, formData).pipe(
            catchError(error => {
                console.error('Error uploading image:', error);
                return throwError(() => new Error('Failed to upload image.'));
            })
        );
    }
}
