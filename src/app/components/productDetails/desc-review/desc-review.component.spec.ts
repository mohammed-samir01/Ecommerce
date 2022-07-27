import { ComponentFixture, TestBed } from '@angular/core/testing';

import { DescReviewComponent } from './desc-review.component';

describe('DescReviewComponent', () => {
  let component: DescReviewComponent;
  let fixture: ComponentFixture<DescReviewComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ DescReviewComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(DescReviewComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
