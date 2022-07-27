import { ComponentFixture, TestBed } from '@angular/core/testing';

import { TopTrendListComponent } from './top-trend-list.component';

describe('TopTrendListComponent', () => {
  let component: TopTrendListComponent;
  let fixture: ComponentFixture<TopTrendListComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ TopTrendListComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(TopTrendListComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
