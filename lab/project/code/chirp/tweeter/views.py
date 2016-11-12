from django.shortcuts import render
# Create your views here.

from django.http import HttpResponse

def index(request):
    return HttpResponse("Chirp! This page is currently under development. Please come back later! :)")
