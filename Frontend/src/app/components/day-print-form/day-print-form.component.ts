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


  Data : PrintInfo[];
  date: MatDatepickerInputEvent<Date>;
  events: string[] = [];
  minDate = new Date(2019, 0, 1);
  maxDate = new Date(2021, 0, 1);
  ddl;
  message;
  type;


  myFilter = (d: Date): boolean => {
    const day = d.getDay();
    // Prevent Saturday and Sunday from being selected.
    return day !== 0 && day !== 6;
  };
  download(ddl: string){
    this.api.downloadGcode(ddl);

  }

  addEvent(type: string, event: MatDatepickerInputEvent<Date>) {
    //Handling the request to the API to get the print data and the fact if the response is empty
    // @ts-ignore
    this.api.getPrintScheduleJson(formatDate(event.value,'yyyy-MM-dd',"en-US")).subscribe((data: PrintInfo[]) =>
    {if(data.length != 0)
      {this.Data = data;console.log(data);
        this.message='';
        this.type = "";}
    else
      {delete this.Data;
        this.message='Il n\'y a pas d\'impression programmée';
        this.type = "info";}
    });
  }

  constructor(private api: ApiService) { }

  ngOnInit() {
  }

}
