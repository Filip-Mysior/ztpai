import { Component, ViewChild } from '@angular/core';
import { Router, ActivatedRoute } from '@angular/router';

import { SetService } from '../../services/set.service';
import { WordService } from '../../services/word.service';
import { ImageService } from '../../services/image.service';
import { UserService } from '../../services/user.service';

import { AddWordModalComponent } from '../../modals/add-word-modal/add-word-modal.component';

@Component({
  selector: 'app-set',
  standalone: true,
  imports: [AddWordModalComponent],
  templateUrl: './set.component.html',
  styleUrl: './set.component.css'
})
export class SetComponent {
    set: any = {};
    unknownWords: any[] = [];
    setId: number = 0;
    @ViewChild(AddWordModalComponent) addWordModal?: AddWordModalComponent;
    
    constructor(
        private setService: SetService,
        private wordService: WordService,
        private imageService: ImageService,
        private userService: UserService,
        private route: ActivatedRoute,
        private router: Router,
    ) {}

    goBack() {
        this.router.navigate(['/']);
    }

    ngOnInit(): void {
        this.route.params.subscribe(params => {
            this.setId = +params['id'];
            this.loadSet();
        });
        
        this.route.queryParams.subscribe(params => {
            if (params['unknownWords']) {
                this.unknownWords = JSON.parse(params['unknownWords']);
                console.log('Unknown Words:', this.unknownWords);
            }
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

    goToLearnPage() {
        this.router.navigate(['/learn', this.setId]);
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
    
    public isUserLoggedIn(): boolean {
        return this.userService.isUserLoggedIn();
    }

    public isUserAdmin(): boolean {
        return this.userService.isUserAdmin();
    }
}
