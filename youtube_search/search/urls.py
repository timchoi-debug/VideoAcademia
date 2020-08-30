from django.urls import path 
from search import views

urlpatterns = [
    path('', views.results, name="results"),
]