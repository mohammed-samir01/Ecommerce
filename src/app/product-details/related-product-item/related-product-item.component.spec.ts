import { ComponentFixture, TestBed } from '@angular/core/testing';

import { RelatedProductItemComponent } from './related-product-item.component';

describe('RelatedProductItemComponent', () => {
  let component: RelatedProductItemComponent;
  let fixture: ComponentFixture<RelatedProductItemComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ RelatedProductItemComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(RelatedProductItemComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
