import { Component, ElementRef, ViewChild, AfterViewInit } from '@angular/core';

import { SetService } from '../../services/set.service';
import { ImageService } from '../../services/image.service';

let $: any;
if (typeof window !== "undefined") {
  // @ts-ignore
  $ = window['$'];
}

@Component({
  selector: 'app-add-set-modal',
  standalone: true,
  imports: [],
  templateUrl: './add-set-modal.component.html',
  styleUrls: ['./add-set-modal.component.css']
})
export class AddSetModalComponent implements AfterViewInit {
    @ViewChild('modal') modal?: ElementRef;
    @ViewChild('fileInput') fileInput?: ElementRef;
    imageId: any;

    constructor(
        private setService: SetService,
        private imageService: ImageService,
    ) {}

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
    
        const setName = ((event.target as HTMLFormElement).elements.namedItem('setName') as HTMLInputElement)?.value;
    
        const file = this.fileInput?.nativeElement.files[0];
        if (file) {
            const formData = new FormData();
            formData.append('image', file);
            console.log(formData);
            console.log('FormData:');
            const formDataObj: { [key: string]: any } = {};
            formData.forEach((value, key) => {
                formDataObj[key] = value;
            });
            console.log(formDataObj);
            this.imageService.uploadImage(formData).subscribe(
                response => {
                    const setFormData = new FormData();
                    setFormData.append('setName', setName);
                    setFormData.append('imageId', response.image_id);
    
                    this.setService.addSet(setFormData).subscribe(
                        () => {
                            console.log('Set added successfully');
                            window.location.reload();
                        },
                        error => {
                            console.error('Error adding set:', error);
                        }
                    );
                },
                error => {
                    console.error('Error uploading image:', error);
                }
            );
        } else {
            console.error('No image selected');
            // Handle error
        }
    }
    
}
