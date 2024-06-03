import { Component } from '@angular/core';
import { Router, ActivatedRoute } from '@angular/router';

import { WordService } from '../../services/word.service';

@Component({
    selector: 'app-learn',
    standalone: true,
    imports: [],
    templateUrl: './learn.component.html',
    styleUrl: './learn.component.css'
})
export class LearnComponent {
    words: any[] = [];
    setId: number = 0;
    currentIndex: number = 0;
    unknownWords: any[] = [];
    isEnglishVisible: boolean = true;
    afterLearn: boolean = true;

    constructor(
        private route: ActivatedRoute,
        private router: Router,
        private wordService: WordService,
    ) {}

    ngOnInit(): void {
        this.route.params.subscribe(params => {
            this.setId = +params['id'];
            this.loadWords();
            this.isEnglishVisible = true;
        });
    }

    goToSetPage(afterLearn: boolean) {
        this.router.navigate(['/set', this.setId], {
            queryParams: {
                unknownWords: JSON.stringify(this.unknownWords),
                afterLearn: afterLearn
            }
        });
    }

    loadWords(): void {
        this.wordService.getWordsInSet(this.setId).subscribe({
            next: data => {
                this.words = data;
                this.currentIndex = 0;
            },
            error: error => {
                console.error('Error fetching set data:', error);
            }
        });
    }

    get currentWord() {
        return this.words[this.currentIndex];
    }

    nextWord(isKnown: boolean): void {
        if (!isKnown) {
            this.unknownWords.push(this.currentWord);
        }
        this.currentIndex++;
        if (this.currentIndex >= this.words.length) {
            this.goToSetPage(true);
        } else {
            this.isEnglishVisible = true;
        }
    }

    toggleWordVisibility(): void {
        this.isEnglishVisible = !this.isEnglishVisible;
    }
}
