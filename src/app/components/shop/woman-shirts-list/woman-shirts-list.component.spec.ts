import { ComponentFixture, TestBed } from '@angular/core/testing';

import { WomanShirtsListComponent } from './woman-shirts-list.component';

describe('WomanShirtsListComponent', () => {
  let component: WomanShirtsListComponent;
  let fixture: ComponentFixture<WomanShirtsListComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ WomanShirtsListComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(WomanShirtsListComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
