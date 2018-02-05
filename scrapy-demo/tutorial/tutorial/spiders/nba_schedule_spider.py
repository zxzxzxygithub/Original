#!/usr/bin/env python
#-*- coding: utf-8 -*-
import scrapy

class NBAScheduleSpider(scrapy.Spider):
    name = "nba-schedule"
    start_urls = [
        "https://nba.hupu.com/schedule",
    ]

    def parse(self, response):
        title = response.xpath('//tr[@class="title"]//td/text()').extract()
        
        for t in title:
            print t.encode('utf-8')
        
        data = response.xpath('//tr[contains(@class, "left")]')

        for detail in data:
            # x = detail.xpath('./td/text()').extract()
            a = detail.xpath('./td/a/text()').extract()
            print a
            for t in a:
                print t.encode('utf-8')