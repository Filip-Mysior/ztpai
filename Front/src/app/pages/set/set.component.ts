import { Component, OnInit } from '@angular/core';
import { RouterLink, ActivatedRoute } from '@angular/router';
import { Location } from '@angular/common';

import { SetService } from '../../services/set.service';
import { ImageService } from '../../services/image.service';

@Component({
  selector: 'app-set',
  standalone: true,
  imports: [RouterLink],
  templateUrl: './set.component.html',
  styleUrl: './set.component.css'
})
export class SetComponent {
    set: any = {};
    setId: number = 0;
    
    constructor(
        private location: Location,
        private setService: SetService,
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

    getImageUrl(imageId: number): string {
        return this.imageService.getImageUrl(imageId);
    }
}
