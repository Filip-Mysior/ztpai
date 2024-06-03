import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { FormControl, FormGroup, ReactiveFormsModule } from '@angular/forms';
import { debounceTime } from 'rxjs/operators';

import { SetService } from '../../services/set.service';
import { ImageService } from '../../services/image.service';

@Component({
    selector: 'app-my-account',
    standalone: true,
    imports: [ReactiveFormsModule],
    templateUrl: './my-account.component.html',
    styleUrl: './my-account.component.css'
})
export class MyAccountComponent implements OnInit {
    sets: any;
    searchControl = new FormControl('');
    searchForm = new FormGroup({
        searchControl: this.searchControl
    });

    constructor(
        private setService: SetService,
        private imageService: ImageService,
        private router: Router,
    ) {}

    ngOnInit(): void {
        this.getHistory();

        this.searchControl.valueChanges.pipe(debounceTime(300)).subscribe(searchTerm => {
            if (searchTerm) {
                this.setService.searchSets(searchTerm).subscribe({
                    next: data => {
                        this.sets = data;
                    },
                    error: error => {
                        console.error('Error searching sets:', error);
                    }
                });
            } else {
                this.getHistory();
            }
        });
    }

    private getHistory() {
        this.setService.getHistory().subscribe({
            next: data => {
                this.sets = data;
            },
            error: error => {
                console.error('Error fetching sets:', error);
            }
        });
    }

    goToSetPage(setId: number) {
        this.router.navigate(['/set', setId]);
    }

    getImageUrl(imageId: number): string {
        return this.imageService.getImageUrl(imageId);
    }
}
