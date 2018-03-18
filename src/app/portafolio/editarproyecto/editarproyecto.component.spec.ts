import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { EditarproyectoComponent } from './editarproyecto.component';

describe('EditarproyectoComponent', () => {
  let component: EditarproyectoComponent;
  let fixture: ComponentFixture<EditarproyectoComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ EditarproyectoComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(EditarproyectoComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
