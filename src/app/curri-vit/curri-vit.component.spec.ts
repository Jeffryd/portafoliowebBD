import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { CurriVitComponent } from './curri-vit.component';

describe('CurriVitComponent', () => {
  let component: CurriVitComponent;
  let fixture: ComponentFixture<CurriVitComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CurriVitComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(CurriVitComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
