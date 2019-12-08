import { Component, OnInit } from '@angular/core';
import {MatDatepickerInputEvent} from "@angular/material/datepicker";
import {ApiService} from "../../services/api.service";
import {DatePipe, formatDate} from "@angular/common";
import {PrintInfo,utilisateur} from '../../Interface/Interface.module';



@Component({
  selector: 'app-day-print-form',
  templateUrl: './day-print-form.component.html',
  styleUrls: ['./day-print-form.component.css']
})

export class DayPrintFormComponent implements OnInit {

  public data: JSON[]=[];
  Data : PrintInfo[];
  date: MatDatepickerInputEvent<Date>;
  events: string[] = [];
  formatDate: string = 'yyyy-MM-dd';


  myFilter = (d: Date): boolean => {
    const day = d.getDay();
    // Prevent Saturday and Sunday from being selected.
    return day !== 0 && day !== 6;
  };


  addEvent(type: string, event: MatDatepickerInputEvent<Date>) {

    // @ts-ignore
    this.api.getPrintScheduleJson(formatDate(event.value,'yyyy-MM-dd',"en-US")).subscribe((data: PrintInfo[]) => this.Data = data);

  }


  constructor(private api: ApiService) { }

  ngOnInit() {
  }

}
