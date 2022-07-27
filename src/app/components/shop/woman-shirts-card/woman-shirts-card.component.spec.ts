import { ComponentFixture, TestBed } from '@angular/core/testing';

import { WomanShirtsCardComponent } from './woman-shirts-card.component';

describe('WomanShirtsCardComponent', () => {
  let component: WomanShirtsCardComponent;
  let fixture: ComponentFixture<WomanShirtsCardComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ WomanShirtsCardComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(WomanShirtsCardComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
