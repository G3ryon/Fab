import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-day-print-form',
  templateUrl: './day-print-form.component.html',
  styleUrls: ['./day-print-form.component.css']
})
export class DayPrintFormComponent implements OnInit {
  myFilter = (d: Date): boolean => {
    const day = d.getDay();
    // Prevent Saturday and Sunday from being selected.
    return day !== 0 && day !== 6;
  };
  constructor() { }

  ngOnInit() {
  }

}
