import { Component, ViewChild, OnInit  } from '@angular/core';
import { Router } from '@angular/router';
import { FormControl, FormGroup, ReactiveFormsModule } from '@angular/forms';
import { debounceTime } from 'rxjs/operators';

import { SetService } from '../../services/set.service';
import { ImageService } from '../../services/image.service';

import { AddSetModalComponent } from '../../modals/add-set-modal/add-set-modal.component';

@Component({
    selector: 'app-home',
    standalone: true,
    imports: [AddSetModalComponent, ReactiveFormsModule],
    templateUrl: './home.component.html',
    styleUrl: './home.component.css',
})
export class HomeComponent implements OnInit {
    sets: any;
    searchControl = new FormControl('');
    searchForm = new FormGroup({
        searchControl: this.searchControl
    });
    @ViewChild(AddSetModalComponent) addSetModal?: AddSetModalComponent;

    constructor(
        private setService: SetService,
        private imageService: ImageService,
        private router: Router,
    ) {}


    ngOnInit(): void {
        this.loadAllSets();

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
                this.loadAllSets();
            }
        });
    }

    openAddSetModal() {
        this.addSetModal?.openModal();
    }

    goToSetPage(setId: number) {
        this.router.navigate(['/set', setId]);
    }

    getImageUrl(imageId: number): string {
        return this.imageService.getImageUrl(imageId);
    }

    private loadAllSets() {
        this.setService.getSets().subscribe({
            next: data => {
                this.sets = data;
            },
            error: error => {
                console.error('Error fetching sets:', error);
            }
        });
    }

    deleteSet(setId: number, event: MouseEvent) {
        event.stopPropagation();
        this.setService.deleteSet(setId).subscribe({
            next: () => {
                this.loadAllSets();
            },
            error: error => {
                console.error('Error deleting set:', error);
            }
        });
    }
}
