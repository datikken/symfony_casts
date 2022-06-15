import asyncio
from playwright.async_api import async_playwright
from database import session, Link

link = Link(url='https://www.jamieoliver.com/')
session.add_all([link])
session.commit()

async def main():
    async with async_playwright() as p:
        browser = await p.chromium.launch()
        page = await browser.new_page()
        await page.goto(link.url)

        links = await page.query_selector_all("a")

        for linx in links:
            print(await linx.get_attribute('href'))

        print(await page.title())
        await browser.close()

asyncio.run(main())
