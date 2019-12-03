import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DayPrintFormComponent } from './day-print-form.component';

describe('DayPrintFormComponent', () => {
  let component: DayPrintFormComponent;
  let fixture: ComponentFixture<DayPrintFormComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DayPrintFormComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DayPrintFormComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
