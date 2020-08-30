from django.shortcuts import render, redirect
import requests
from django.conf import settings
from isodate import parse_duration

# Create your views here.

def index(request):
    link = 'https://www.googleapis.com/youtube/v3/search/'
    videos = 'https://www.googleapis.com/youtube/v3/videos/'

    search_args = {
        'part' : 'snippet',
         'q' : request.POST['search'],
         'key' : settings.YOUTUBE_DATA_API_KEY,
         'max results' : 30,
         'type' : 'video'
    }

    query = requests.get(link, params=search_args)

    results = query.json()['items']

    video_list = []
    for result in results:
        video_list.append(result['id']['videoId'])
    
    video_args = {
        'key' : settings.YOUTUBE_DATA_API_KEY,
        'part' : 'snippet,contentDetails',
        'id' : ','.join(video_list),
        'maxResults' : 30
    }

    query = requests.get(videos, params=video_args)

    results = query.json()['items']

    for result in results:
        video_item = {
            'title' : result['snippet']['title'],
            'id' : result['id'],
            'url' : f'https://www.youtube.com/watch?v={ result["id"] }',
            'duration' : int(parse_duration(result['contentDetails']['duration']).total_seconds()),
            'thumbnail' : result['snippet']['thumbnails']['high']['url']
        }
        video_list.append(video_item)
    
    context = {
        'videos' : video_list
    }

    return render(request, 'search/results.html', context)
