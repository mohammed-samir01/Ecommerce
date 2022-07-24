import { ComponentFixture, TestBed } from '@angular/core/testing';

import { TopTrendItemComponent } from './top-trend-item.component';

describe('TopTrendItemComponent', () => {
  let component: TopTrendItemComponent;
  let fixture: ComponentFixture<TopTrendItemComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ TopTrendItemComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(TopTrendItemComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
