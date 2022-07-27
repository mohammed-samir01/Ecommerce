import { ComponentFixture, TestBed } from '@angular/core/testing';

import { CateogryCardComponent } from './cateogry-card.component';

describe('CateogryCardComponent', () => {
  let component: CateogryCardComponent;
  let fixture: ComponentFixture<CateogryCardComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ CateogryCardComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(CateogryCardComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
