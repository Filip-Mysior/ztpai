import { Component, ElementRef, ViewChild, AfterViewInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';

import { WordService } from '../../services/word.service';
import { ImageService } from '../../services/image.service';

let $: any;
if (typeof window !== "undefined") {
  // @ts-ignore
  $ = window['$'];
}

@Component({
    selector: 'app-add-word-modal',
    standalone: true,
    imports: [],
    templateUrl: './add-word-modal.component.html',
    styleUrl: './add-word-modal.component.css'
})
export class AddWordModalComponent {
    @ViewChild('modal') modal?: ElementRef;
    setId: any = 0;

    constructor(
        private wordService: WordService,
        private route: ActivatedRoute,
    ) {}

    ngOnInit(): void {
        this.route.params.subscribe(params => {
            this.setId = +params['id'];
        });
    }

    ngAfterViewInit() {
        if ($) {
            $(this.modal?.nativeElement).modal('hide');
        }
    }

    openModal() {
        if ($) {
            $(this.modal?.nativeElement).modal('show');
        }
    }

    closeModal() {
        if ($) {
            $(this.modal?.nativeElement).modal('hide');
        }
    }


    submitForm(event: Event) {
        event.preventDefault();
    
        const word_en = ((event.target as HTMLFormElement).elements.namedItem('word_en') as HTMLInputElement)?.value;
        const word_pl = ((event.target as HTMLFormElement).elements.namedItem('word_pl') as HTMLInputElement)?.value;
    
        const formData = new FormData();
        formData.append('word_en', word_en);
        formData.append('word_pl', word_pl);
        formData.append('setId', this.setId);

        this.wordService.addWord(formData).subscribe(
            response => {
                console.log('Word added successfully');
                window.location.reload();
            },
            error => {
                console.error('Error uploading image:', error);
            }
        );
    }
}
