import { Component, ViewChild, OnInit  } from '@angular/core';
import { RouterLink, Router } from '@angular/router';

import { SetService } from '../../services/set.service';
import { ImageService } from '../../services/image.service';

import { AddSetModalComponent } from '../../modals/add-set-modal/add-set-modal.component';

@Component({
    selector: 'app-home',
    standalone: true,
    imports: [RouterLink, AddSetModalComponent],
    templateUrl: './home.component.html',
    styleUrl: './home.component.css',
})
export class HomeComponent implements OnInit {
    sets: any;
    @ViewChild(AddSetModalComponent) addSetModal?: AddSetModalComponent;

    constructor(
        private setService: SetService,
        private imageService: ImageService,
        private router: Router,
    ) {}


    ngOnInit(): void {
        this.setService.getSets().subscribe({
            next: data => {
                this.sets = data;
            },
            error: error => {
                console.error('Error fetching user data:', error);
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

    deleteSet(setId: number, event: MouseEvent) {
        event.stopPropagation();
        this.setService.deleteSet(setId).subscribe({
            next: () => {
                this.refreshSets();
            },
            error: error => {
                console.error('Error deleting set:', error);
            }
        });
    }

    refreshSets() {
        this.setService.getSets().subscribe({
            next: data => {
                this.sets = data;
            },
            error: error => {
                console.error('Error fetching sets:', error);
            }
        });
    }
}
