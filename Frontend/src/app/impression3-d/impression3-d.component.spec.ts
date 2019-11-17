import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { Impression3DComponent } from './impression3-d.component';

describe('Impression3DComponent', () => {
  let component: Impression3DComponent;
  let fixture: ComponentFixture<Impression3DComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ Impression3DComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(Impression3DComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
