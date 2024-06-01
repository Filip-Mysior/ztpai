import { Component, ViewChild } from '@angular/core';
import { RouterLink, ActivatedRoute } from '@angular/router';
import { Location } from '@angular/common';

import { SetService } from '../../services/set.service';
import { WordService } from '../../services/word.service';
import { ImageService } from '../../services/image.service';

import { AddWordModalComponent } from '../../modals/add-word-modal/add-word-modal.component';

@Component({
  selector: 'app-set',
  standalone: true,
  imports: [RouterLink, AddWordModalComponent],
  templateUrl: './set.component.html',
  styleUrl: './set.component.css'
})
export class SetComponent {
    set: any = {};
    setId: number = 0;
    @ViewChild(AddWordModalComponent) addWordModal?: AddWordModalComponent;
    
    constructor(
        private location: Location,
        private setService: SetService,
        private wordService: WordService,
        private imageService: ImageService,
        private route: ActivatedRoute,
    ) {}

    goBack() {
        this.location.back();
    }

    ngOnInit(): void {
        this.route.params.subscribe(params => {
            this.setId = +params['id'];
            this.loadSet();
        });
    }

    loadSet(): void {
        this.setService.getSet(this.setId).subscribe({
            next: data => {
                this.set = data;
            },
            error: error => {
                console.error('Error fetching set data:', error);
            }
        });
    }

    openAddWordModal() {
        this.addWordModal?.openModal();
    }

    getImageUrl(imageId: number): string {
        return this.imageService.getImageUrl(imageId);
    }

    deleteWord(wordId: number, event: MouseEvent) {
        event.stopPropagation();
        this.wordService.deleteWord(wordId).subscribe({
            next: () => {
                this.loadSet();
            },
            error: error => {
                console.error('Error deleting word:', error);
            }
        });
    }
}
