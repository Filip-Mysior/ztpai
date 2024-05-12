import { Component } from '@angular/core';
import { RouterLink } from '@angular/router';
import { Location } from '@angular/common';

@Component({
  selector: 'app-set',
  standalone: true,
  imports: [RouterLink],
  templateUrl: './set.component.html',
  styleUrl: './set.component.css'
})
export class SetComponent {

    constructor(private location: Location) {}

    goBack() {
        this.location.back();
      }
}
